require("./bootstrap");

import { createApp } from "vue";
import Component from "./components/MonComponent";

const app = createApp({});

app.component("my-component", Component);

app.mount("#app");

