// export default {
//     plugins: {
//         'tailwindcss/nesting': 'postcss-nesting',
//         tailwindcss: {},
//         autoprefixer: {},
//     },
// };
// postcss.config.cjs
// postcss.config.cjs
// import postcssNesting from 'postcss-nesting';
// // import tailwindcss from '@tailwindcss/postcss';
// import autoprefixer from 'autoprefixer';
// import tailwindcss from 'tailwindcss';
//
//
// export default {
//     plugins: [
//         postcssNesting,
//         tailwindcss,
//         autoprefixer,
//     ],
// };
// postcss.config.cjs
// postcss.config.cjs
// module.exports = {
//     plugins: {
//         'postcss-nesting': {},
//         tailwindcss: {},
//         autoprefixer: {},
//     },
// };
export default {
    plugins: {
        "@tailwindcss/postcss": {},
        autoprefixer: {},
    },
};
