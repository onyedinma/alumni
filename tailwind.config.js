module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['"Inter"', 'sans-serif'],
                serif: ['"Playfair Display"', 'serif'],
            },
            colors: {
                primary: '#701c1c', // Deep Maroon
                secondary: '#1a1a1a', // Charcoal
                accent: '#c5a059', // Gold
                ivory: '#f9f7f2', // Off-white background
                maroon: {
                    50: '#fdf2f2',
                    100: '#fde6e6',
                    200: '#fbd0d0',
                    300: '#f7aaaa',
                    400: '#f17b7b',
                    500: '#e84f4f',
                    600: '#d42a2a',
                    700: '#b01f1f',
                    800: '#8e1c1c',
                    900: '#701c1c',
                },
                gold: {
                    50: '#fbf8f1',
                    100: '#f5efde',
                    200: '#ebdcb8',
                    300: '#dfc38d',
                    400: '#d1a866',
                    500: '#c5a059',
                    600: '#a87f46',
                    700: '#876039',
                    800: '#6f4d33',
                    900: '#5c3f2e',
                },
            }
        },
    },
    plugins: [],
}
