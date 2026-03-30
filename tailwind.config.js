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
        themes: [
            {
                gdib: {
                    "primary": "#002B5B",     // Deep Official Blue
                    "secondary": "#E00000",   // Strong Official Red
                    "accent": "#FFD700",      // Government Gold
                    "neutral": "#1e293b",     // Dark Slate for text
                    "base-100": "#ffffff",    // Pure White Background
                    "base-200": "#f8fafc",    // Light Grey for section backgrounds
                    "base-300": "#f1f5f9",    // Slightly darker for borders
                    "info": "#3b82f6",
                    "success": "#16a34a",
                    "warning": "#eab308",
                    "error": "#dc2626",
                },
            },
            "corporate", // Keep corporate as a backup
        ],
        // Force the new custom 'gdib' theme for everyone, even in dark mode
        darkTheme: "gdib",
    },
};
