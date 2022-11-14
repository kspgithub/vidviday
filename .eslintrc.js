module.exports = {
    root: true,
    parser: 'vue-eslint-parser',
    parserOptions: {
        ecmaVersion: 2020, // Use the latest ecmascript standard
        sourceType: 'module', // Allows using import/export statements
    },
    env: {
        browser: true,
        node: true,
    },
    extends: ['plugin:vue/vue3-recommended', 'eslint:recommended', 'prettier'],
    plugins: ['prettier'],
    rules: {
        'prettier/prettier': [
            'error',
            {},
            {
                usePrettierrc: true,
            },
        ],

        'no-undef': ['off'],
        'no-unused-vars': ['off'],

        'vue/multi-word-component-names': ['off'],
        'vue/no-v-html': ['off'],
        'vue/no-v-text-v-html-on-component': ['off'],
        'vue/require-default-prop': ['off'],
        'vue/require-prop-types': ['off'],
        'vue/require-v-for-key': ['off'],
    },
}
