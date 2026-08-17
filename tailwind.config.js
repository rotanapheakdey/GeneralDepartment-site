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
                sans: ["Kantumruy Pro", "Siemreap", "Koh Santepheap", "Inter", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "moi-blue": "#0B3C95",
                "moi-navy": "#082866",
                "moi-blue-hover": "#1D4ED8",
                "moi-blue-50": "#EFF6FF",
                "moi-red": "#D91A2A",
                "moi-slate-50": "#F8FAFC",
                "moi-slate-200": "#E2E8F0",
                "moi-slate-300": "#CBD5E1",
                "moi-slate-500": "#64748B",
                "moi-slate-900": "#0F172A",
            },
            keyframes: {
                shimmer: {
                    '100%': { transform: 'translateX(100%)' }
                }
            },
            animation: {
                shimmer: 'shimmer 2s infinite',
            }
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
                moinfo: {
                    "primary": "#0B3C95",
                    "primary-focus": "#1D4ED8",
                    "secondary": "#082866",
                    "accent": "#D91A2A",
                    "neutral": "#0F172A",
                    "base-100": "#ffffff",
                    "base-200": "#F8FAFC",
                    "base-300": "#E2E8F0",
                    "info": "#3b82f6",
                    "success": "#16a34a",
                    "warning": "#eab308",
                    "error": "#D91A2A",
                },
            },
            "corporate",
        ],
        darkTheme: "moinfo",
    },
};
