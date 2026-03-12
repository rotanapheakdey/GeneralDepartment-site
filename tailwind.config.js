import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "gov-blue": "#002B5B",
                "gov-gold": "#FFD700",
            },
        },
    },

    plugins: [
        forms,
        typography,
        require("daisyui")
    ],

    daisyui: {
        themes: ["corporate"], // Only Corporate Light
        darkTheme: "corporate", // Forces Dark mode users to see Corporate Light
    },
};
