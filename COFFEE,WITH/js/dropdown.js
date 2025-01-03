document.addEventListener('DOMContentLoaded', () => {
    const dropdowns = document.querySelectorAll('.dropdown');

    dropdowns.forEach(dropdown => {
        const button = dropdown.querySelector('.dropdown-button');
        const content = dropdown.querySelector('.dropdown-content');

        // 드롭다운 열기 (hover)
        dropdown.addEventListener('mouseover', () => {
            // 다른 드롭다운 닫기
            dropdowns.forEach(otherDropdown => {
                if (otherDropdown !== dropdown) {
                    otherDropdown.classList.remove('open');
                }
            });

            // 현재 드롭다운 열기
            dropdown.classList.add('open');
        });

        // 드롭다운 닫기 (hover에서 벗어날 때)
        dropdown.addEventListener('mouseout', () => {
            dropdown.classList.remove('open');
        });
    });
});

