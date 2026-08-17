import "../css/app.css";
import "./bootstrap";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";
import { createI18n } from "vue-i18n";
import revealDirective from "./Directives/reveal";

// Import language files
import en from "./lang/en.json";
import km from "./lang/km.json";

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

// Configure i18n
const i18n = createI18n({
    legacy: false,
    locale: "km",
    fallbackLocale: "km",
    messages: { en, km },
});

createInertiaApp({
    title: (title) => title,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(i18n)
            .directive('reveal', revealDirective)
            .mount(el);
    },
    progress: {
        // We handle colors and thickness via custom CSS in app.css
        color: false,
        showSpinner: true,
    },
});
