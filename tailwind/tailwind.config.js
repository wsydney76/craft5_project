module.exports = {

    theme: {
        extend: {
        }
    },
    variants: {},
    plugins: [],

    purge: {
        content: [
            '../templates/**/*.html',
            '../templates/**/*.twig'
        ],

        // These options are passed through directly to PurgeCSS
        options: {
            whitelistPatterns: [
                /embed-\w+/,
                /position-\w/,
                /iframe/
            ]
        }
    },

    future: {
        // Avoid deprecated features
        removeDeprecatedGapUtilities: true,
        purgeLayersByDefault: true
    },
}
