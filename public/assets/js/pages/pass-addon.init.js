/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/js/pages/pass-addon.init.js ***!
  \***********************************************/
/*
Template Name: SAMS - Samhitha of Ayurvedic Medical Specialities
Author: Web Mahal Web Service
Website: https://webmahal.com/
Contact: webmahal@gmail.com
File: Password Addon Js File
*/
// show password input value
document.getElementById('password-addon').addEventListener('click', function () {
  var passwordInput = document.getElementById("password-input");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
});
/******/ })()
;
