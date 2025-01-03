document.getElementById('add_stamp_btn').addEventListener('click', function () {
    fetch('stamp.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'add_stamp=1', // POST 데이터 전달
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'checked') {
                // 출석체크 성공 시
                alert('출석체크 완료! 현재 스탬프 수: ' + data.stamps);
                updateStamps(data.stamps); // 화면 갱신
            } else if (data.status === 'already_checked') {
                // 이미 출석체크 했을 경우
                alert('오늘은 이미 출석체크를 했습니다!');
            } else {
                // 오류 발생 시
                alert('오류가 발생했습니다. 다시 시도해주세요.');
            }
        })
        .catch(error => {
        });
});

// 화면 갱신 함수
function updateStamps(stampCount) {
    const stampImages = document.querySelectorAll('#stamp_img img');
    stampImages.forEach((img, index) => {
        if (index < stampCount) {
            img.src = './img/stamp.png'; // 스탬프 채워진 이미지
        } else {
            img.src = './img/stamp_null.png'; // 스탬프 비어있는 이미지
        }
    });

    // 스탬프 10개 모았을 때 쿠폰 버튼 활성화
    const couponButton = document.getElementById('get_coupon_btn');
    if (stampCount >= 10) {
        couponButton.disabled = false;
    }
}
