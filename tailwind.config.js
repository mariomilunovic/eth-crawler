/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {
            width: {
                400: "400px",
                600: "600px",
                800: "800px",
            },

            screens: {
                sm: "600px",
                // => @media (min-width: 640px) { ... }

                md: "750px",
                // => @media (min-width: 768px) { ... }

                lg: "1000px",
                // => @media (min-width: 1024px) { ... }

                xl: "1280px",
                // => @media (min-width: 1280px) { ... }

                "2xl": "1536px",
                // => @media (min-width: 1536px) { ... }
            },
        },
    },
    plugins: [],
};
