(function() {
  angular.module('relativeDate', []).value('now', new Date()).filter('relativeDate', [
    'now', function(now) {
      return function(date) {
        var calculateDelta, day, delta, hour, minute, month, week, year;
        if (!(date instanceof Date)) {
          date = new Date(date);
        }
        delta = null;
        minute = 60;
        hour = minute * 60;
        day = hour * 24;
        week = day * 7;
        month = day * 30;
        year = day * 365;
        calculateDelta = function() {
          return delta = Math.round((now - date) / 1000);
        };
        calculateDelta();
        if (delta > day && delta < week) {
          date = new Date(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0);
          calculateDelta();
        }
        switch (false) {
          case !(delta < 30):
            return 'gerade eben';
          case !(delta < minute):
            return 'vor ' + delta + " Sekunden";
          case !(delta < 2 * minute):
            return 'vor einer Minute';
          case !(delta < hour):
            return "vor " + (Math.floor(delta / minute)) + " Minuten";
          case Math.floor(delta / hour) !== 1:
            return 'vor einer Stunde';
          case !(delta < day):
            return "vor " + (Math.floor(delta / hour)) + " Stunden";
          case !(delta < day * 2):
            return 'Gestern';
          case !(delta < week):
            return "vor " + (Math.floor(delta / day)) + " Tagen";
          case Math.floor(delta / week) !== 1:
            return 'a week ago';
          case !(delta < month):
            return "vor " + (Math.floor(delta / week)) + " Wochen";
          case Math.floor(delta / month) !== 1:
            return 'vor einem Monat';
          case !(delta < year):
            return "vor " + (Math.floor(delta / month)) + " Monaten";
          case Math.floor(delta / year) !== 1:
            return 'vor einem Jahr';
          default:
            return 'vor über einem Jahr';
        }
      };
    }
  ]);

}).call(this);
