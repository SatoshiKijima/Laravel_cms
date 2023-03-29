import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// resources/js/app.js

import flatpickr from "flatpickr";

// 日付のフォーマットを定義する
const dateFormat = "Y/m/d";

// flatpickrを初期化する
flatpickr(".flatpickr", {
  dateFormat: dateFormat,
  maxDate: new Date(),
});

const menuBtn = document.querySelector('nav a');
const menu = document.querySelector('#menu');

menuBtn.addEventListener('click', () => {
  menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
});