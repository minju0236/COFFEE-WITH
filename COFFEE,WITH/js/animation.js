document.addEventListener('DOMContentLoaded', () => {
    const img3 = document.querySelector('.img3');
    const img1 = document.querySelector('.img1');
    const img2 = document.querySelector('.img2');

    // IntersectionObserver 콜백 함수
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.target === img3) {
                if (entry.isIntersecting) {
                    img3.classList.add('active');
                } else {
                    img3.classList.remove('active');
                }
            }
            
            if (entry.target === img1 || entry.target === img2) {
                if (entry.isIntersecting) {
                    img1.classList.add('active');
                    img2.classList.add('active');
                } else {
                    img1.classList.remove('active');
                    img2.classList.remove('active');
                }
            }
        });
    });

    // 각 이미지에 대해 observer 적용
    observer.observe(img3);
    observer.observe(img1);
    observer.observe(img2);
});
