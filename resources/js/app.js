import "./bootstrap";

import Alpine from "alpinejs";
import persist from "@alpinejs/persist";
Alpine.plugin(persist);
import collapse from "@alpinejs/collapse";
Alpine.plugin(collapse);
window.Alpine = Alpine;
Alpine.start();
