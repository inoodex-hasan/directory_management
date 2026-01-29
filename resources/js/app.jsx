import { createRoot } from 'react-dom/client'
import { createInertiaApp } from '@inertiajs/react'

import '../css/app.css'

createInertiaApp({
  resolve: async (name) => {
    return (await import(`./Pages/${name}.jsx`)).default
  },
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />)
  },
})
