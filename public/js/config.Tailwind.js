tailwind.config = {
    content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
    theme: {
        extend: {
            screens: {
                ssm: '390px',
                smr: '550px',
            }
        }
    }
}