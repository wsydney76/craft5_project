/** @type {import('tailwindcss').Config} */
import colors from 'tailwindcss/colors'

export default {
  content: [
      "./templates/**/*.{twig,svg}"
  ],
  theme: {
    extend: {
        screens: {
            ml: '892px'
        },

        colors: {
            gray: colors.slate
        }
    },
  },
  plugins: [
      require('@tailwindcss/typography')
  ],
}
