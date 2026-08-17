const revealDirective = {
    mounted(el) {
        el.classList.add('reveal');
        
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        // Optional: Stop observing once revealed
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.1, // Trigger when 10% visible
                rootMargin: '0px 0px -50px 0px' // Slightly trigger before fully in view
            }
        );

        observer.observe(el);
    }
};

export default revealDirective;
