import "./bootstrap";
import 'select2';
import "../css/app.css";
import "../sass/app.scss";
import "../css/swiper-bundle.min.css";
import "../js/swiper-bundle.min.js";
import Chart from './components/Chart.vue';
import GenderChart from './components/GenderChart.vue';
import "@protonemedia/laravel-splade/dist/style.css";
import Cdn from "./components/Cdn.vue";
import Time from './components/Axios.vue';
import Clender from './components/Clender.vue';
import Loader from './components/Loader.vue';
import Sidebar from './components/Sidebar.vue';
import Prescription from './components/Prescription.vue';
import '../../public/html2canvas.min';
import { createApp } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";
import './jquery.js';
const el = document.getElementById("app");
import Editor from './components/Editor.vue';
import "../css/jodit.css";
import Rate from './components/Rate.vue';
import SwupComp from './components/Swup.vue';

import Swup from 'swup';



createApp({
    render: renderSpladeApp({ el }),
})
    .use(SpladePlugin, {
        "max_keep_alive": 10,
        "transform_anchors": false,
        "progress_bar": true
    })
    .component('chart',Chart)
    .component('loader',Loader)
    .component('genderChart',GenderChart)
    .component('timeCo',Time)
    .component('sidebar',Sidebar)
    .component('clender',Clender)
    .component('editor',Editor)
    .component('rate',Rate)
    .component('cdn',Cdn)
    .component('swup',SwupComp)
    .component('prescription',Prescription)
    .mount(el);
