/**
 * @author: Shaiful Islam <kuvic16@gmail.com>
 * @since version 1.0
 */

'use strict';
var app = angular.module('auto',['ngRoute','ngResource', 'ngMaterial', ], function($interpolateProvider) {
    alert();
    $interpolateProvider.startSymbol('{{');
    $interpolateProvider.endSymbol('}}');
});


