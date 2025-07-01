/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#f0f9f0',
          100: '#a8e6a1',
          200: '#50c878',
          300: '#3ba776',
          400: '#2d8f5f',
          500: '#2d8f5f',
          600: '#256b4a',
          700: '#1d5039',
          800: '#153a2a',
          900: '#0e251c',
        },
        secondary: {
          50: '#ecf0f1',
          100: '#7f8c8d',
          200: '#2c3e50',
        }
      },
      fontFamily: {
        'poppins': ['Poppins', 'sans-serif'],
      },
      animation: {
        'float': 'float 15s ease-in-out infinite',
        'slide': 'slide 25s linear infinite',
        'sparkle': 'sparkle 20s linear infinite',
        'glow': 'glow 2s ease-in-out infinite alternate',
        'bounce-rotate': 'bounceRotate 3s ease-in-out infinite',
        'border-glow': 'borderGlow 3s ease-in-out infinite',
        'scale-in-up': 'scaleInUp 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275)',
        'slide-in-down-bounce': 'slideInDownBounce 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55)',
      },
      keyframes: {
        float: {
          '0%, 100%': { transform: 'translateY(0px) scale(1)' },
          '33%': { transform: 'translateY(-20px) scale(1.1)' },
          '66%': { transform: 'translateY(10px) scale(0.95)' },
        },
        slide: {
          '0%': { transform: 'translateX(-100%)' },
          '100%': { transform: 'translateX(100%)' },
        },
        sparkle: {
          '0%': { transform: 'translateY(0px) rotate(0deg)' },
          '50%': { transform: 'translateY(-10px) rotate(180deg)' },
          '100%': { transform: 'translateY(0px) rotate(360deg)' },
        },
        glow: {
          '0%': { textShadow: '0 0 10px rgba(80, 200, 120, 0.8), 0 0 20px rgba(80, 200, 120, 0.6)' },
          '100%': { textShadow: '0 0 20px rgba(80, 200, 120, 1), 0 0 30px rgba(80, 200, 120, 0.8)' },
        },
        bounceRotate: {
          '0%, 100%': { transform: 'rotate(0deg) scale(1)' },
          '25%': { transform: 'rotate(5deg) scale(1.1)' },
          '50%': { transform: 'rotate(-5deg) scale(1)' },
          '75%': { transform: 'rotate(3deg) scale(1.05)' },
        },
        borderGlow: {
          '0%, 100%': { boxShadow: '0 0 20px rgba(45, 143, 95, 0.3)' },
          '50%': { boxShadow: '0 0 40px rgba(45, 143, 95, 0.6), 0 0 60px rgba(45, 143, 95, 0.4)' },
        },
        scaleInUp: {
          '0%': { 
            transform: 'scale(0.8) translateY(30px)',
            opacity: '0'
          },
          '100%': { 
            transform: 'scale(1) translateY(0)',
            opacity: '1'
          },
        },
        slideInDownBounce: {
          '0%': { 
            transform: 'translateY(-100px)',
            opacity: '0'
          },
          '60%': { 
            transform: 'translateY(10px)',
            opacity: '1'
          },
          '100%': { 
            transform: 'translateY(0)',
            opacity: '1'
          },
        },
      },
    },
  },
  plugins: [],
}
