/**
 * angular-chosen-localytics - Angular Chosen directive is an AngularJS Directive that brings the Chosen jQuery in a Angular way
 * @version v1.9.2
 * @link http://github.com/leocaseiro/angular-chosen
 * @license MIT
 */
(function() {
  var chosenModule,
    indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

  angular.module('localytics.directives', []);

  chosenModule = angular.module('localytics.directives');

  chosenModule.provider('chosen', function() {
    var options;
    options = {};
    return {
      setOption: function(newOpts) {
        angular.extend(options, newOpts);
      },
      $get: function() {
        return options;
      }
    };
  });

  chosenModule.directive('chosen', [
    'chosen', '$timeout', '$parse', function(config, $timeout, $parse) {
      var CHOSEN_OPTION_WHITELIST, NG_OPTIONS_REGEXP, isEmpty, snakeCase;
      NG_OPTIONS_REGEXP = /^\s*([\s\S]+?)(?:\s+as\s+([\s\S]+?))?(?:\s+group\s+by\s+([\s\S]+?))?\s+for\s+(?:([\$\w][\$\w]*)|(?:\(\s*([\$\w][\$\w]*)\s*,\s*([\$\w][\$\w]*)\s*\)))\s+in\s+([\s\S]+?)(?:\s+track\s+by\s+([\s\S]+?))?$/;
      CHOSEN_OPTION_WHITELIST = ['persistentCreateOption', 'createOptionText', 'createOption', 'skipNoResults', 'noResultsText', 'allowSingleDeselect', 'disableSearchThreshold', 'disableSearch', 'enableSplitWordSearch', 'inheritSelectClasses', 'maxSelectedOptions', 'placeholderTextMultiple', 'placeholderTextSingle', 'searchContains', 'singleBackstrokeDelete', 'displayDisabledOptions', 'displaySelectedOptions', 'width', 'includeGroupLabelInSelected', 'maxShownResults'];
      snakeCase = function(input) {
        return input.replace(/[A-Z]/g, function($1) {
          return "_" + ($1.toLowerCase());
        });
      };
      isEmpty = function(value) {
        var key;
        if (angular.isArray(value)) {
          return value.length === 0;
        } else if (angular.isObject(value)) {
          for (key in value) {
            if (value.hasOwnProperty(key)) {
              return false;
            }
          }
        }
        return true;
      };
      return {
        restrict: 'A',
        require: ['select', '?ngModel'],
        priority: 1,
        link: function(scope, element, attr, ctrls) {
          var $render, chosen, directiveOptions, disableIfEmpty, empty, initIfNot, match, ngModel, ngSelect, options, startLoading, stopLoading, timer, trackBy, valuesExpr, viewWatch;
          scope.disabledValuesHistory = scope.disabledValuesHistory ? scope.disabledValuesHistory : [];
          element = $(element);
          element.addClass('localytics-chosen');
          ngSelect = ctrls[0];
          ngModel = ctrls[1];
          match = attr.ngOptions && attr.ngOptions.match(NG_OPTIONS_REGEXP);
          valuesExpr = match && $parse(match[7]);
          trackBy = match && match[8];
          directiveOptions = scope.$eval(attr.chosen) || {};
          options = angular.copy(config);
          angular.extend(options, directiveOptions);
          angular.forEach(attr, function(value, key) {
            if (indexOf.call(CHOSEN_OPTION_WHITELIST, key) >= 0) {
              return attr.$observe(key, function(value) {
                var prefix;
                prefix = String(element.attr(attr.$attr[key])).slice(0, 2);
                options[snakeCase(key)] = prefix === '{{' ? value : scope.$eval(value);
                return disableIfEmpty();
              });
            }
          });
          startLoading = function() {
            return element.addClass('loading').attr('disabled', true).trigger('chosen:updated');
          };
          stopLoading = function() {
            element.removeClass('loading');
            if (angular.isDefined(attr.disabled)) {
              element.attr('disabled', attr.disabled);
            } else {
              element.attr('disabled', false);
            }
            return element.trigger('chosen:updated');
          };
          chosen = null;
          empty = false;
          initIfNot = function() {
            if (!chosen) {
              return scope.$evalAsync(function() {
                if (!chosen) {
                  return chosen = element.chosen(options).data('chosen');
                }
              });
            }
          };
          disableIfEmpty = function() {
            if (chosen && empty) {
              element.attr('disabled', true);
            }
            return element.trigger('chosen:updated');
          };
          if (ngModel) {
            $render = ngModel.$render;
            ngModel.$render = function() {
              var isPrimitive, nextValue, previousValue, valueChanged;
              initIfNot();
              try {
                previousValue = ngSelect.readValue();
              } catch (error) {}
              $render();
              try {
                nextValue = ngSelect.readValue();
              } catch (error) {}
              isPrimitive = !trackBy && !attr.multiple;
              valueChanged = isPrimitive ? previousValue !== nextValue : !angular.equals(previousValue, nextValue);
              if (valueChanged) {
                return element.trigger('chosen:updated');
              }
            };
            element.on('chosen:hiding_dropdown', function() {
              return scope.$applyAsync(function() {
                return ngModel.$setTouched();
              });
            });
            if (attr.multiple) {
              viewWatch = function() {
                return ngModel.$viewValue;
              };
              scope.$watch(viewWatch, ngModel.$render, true);
            }
          }
          attr.$observe('disabled', function() {
            return element.trigger('chosen:updated');
          });
          if (attr.ngOptions && ngModel) {
            timer = null;
            scope.$watchCollection(valuesExpr, function(newVal, oldVal) {
              return timer = $timeout(function() {
                if (angular.isUndefined(newVal)) {
                  return startLoading();
                } else {
                  empty = isEmpty(newVal);
                  stopLoading();
                  return disableIfEmpty();
                }
              });
            });
            return scope.$on('$destroy', function(event) {
              if (timer != null) {
                return $timeout.cancel(timer);
              }
            });
          }
        }
      };
    }
  ]);

}).call(this);

angular.module('components', [])
   .directive('capitalize', function() {
    return {
        require: 'ngModel',        
        link: function(scope, element, attrs, modelCtrl) {
            modelCtrl.$parsers.push(function(input) {
                return input ? input.toUpperCase() : "";
            });
            element.css("text-transform","uppercase");
        }
    };
});

angular.module('stringToNumber', [])
.directive('stringToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(value) {
        return '' + value;
      });
      ngModel.$formatters.push(function(value) {
        return parseFloat(value);
      });
    }
  };
});

angular.module("html-unsafe",[])
.directive('ngBindHtmlUnsafe', [function() {
    return function(scope, element, attr) {
        element.addClass('ng-binding').data('$binding', attr.ngBindHtmlUnsafe);
        scope.$watch(attr.ngBindHtmlUnsafe, function ngBindHtmlUnsafeWatchAction(value) {
            element.html(value || '');
        });
    }
}]);

angular.module('files', [])
 .directive("ngUploadChange",function(){
    return{
        scope:{
            ngUploadChange:"&"
        },
        link:function($scope, $element, $attrs){
            $element.on("change",function(event){
                $scope.$apply(function(){
                    $scope.ngUploadChange({$event: event})
                })
            })
            $scope.$on("$destroy",function(){
                $element.off();
            });
        }
    }
});

/*angular.module('dataTables', [])
.directive("tableFull",function(){

  var table = '<table style="width:100%">';
            + '<tr>';
              + '<th ng-repeat="item in data.headList">{{ item.name }}</th>';
            + '</tr>';
            +'<tr ng-repeat="item in data.rowList">';
            +'<td> {{ item.name }} </td>';
            +'<td> {{ item.surname }} </td>'; 
            +'<td>{{ item.propertyName }}</td>';
            +'</tr>';
            +'</table>';
  return {
        restrict: 'EA', //E = element, A = attribute, C = class, M = comment         
        scope: {
            datos: '='         
          },
          template: table,
        }

});*/


angular.module('dataTable',[] ).directive('dataTable', function(){
  
  return {
     restrict: 'EA', //E = element, A = attribute, C = class, M = comment         
      scope: {
          data: '='
      },
      template: '<div>HOla</div>', 
  }

});


/*angular.module("angular-icheck",[])
.directive('iCheck', function($timeout) {
    return {
      link: function(scope, element, attrs) {
        return $timeout(function() {
          return $(element).iCheck({
            checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal-blue',
            checkboxClass: 'icheckbox_minimal-blue',
            increaseArea: '20%'
          });
        });
      }
    };
  })*/