function check_input() {
    const form = document.member_form;
    const id = form.id.value.trim();
    const pass = form.pass.value;
    const name = form.name.value.trim();
    const email1 = form.email1.value.trim();
    const email2 = form.email2.value.trim();
    const email = `${email1}@${email2}`;

    // 아이디
    if (id.length < 5 || id.length > 15) {
        alert("아이디는 5~15자리여야 합니다.");
        form.id.focus();
        return;
    }

    // 비밀번호
    const passRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/;
    if (!passRegex.test(pass)) {
        alert("비밀번호는 8자리 이상이며, 1개 이상의 대문자, 특수문자를 포함해야 합니다.");
        form.pass.focus();
        return;
    }

    if (!document.member_form.pass.value) {
        alert("비밀번호를 입력하세요!");
        document.member_form.pass.focus();
        return;
    }

    if (!document.member_form.pass_confirm.value) {
        alert("비밀번호확인을 입력하세요!");
        document.member_form.pass_confirm.focus();
        return;
    }

    if (!document.member_form.name.value) {
        alert("이름을 입력하세요!");
        document.member_form.name.focus();
        return;
    }

    if (!document.member_form.email1.value) {
        alert("이메일 주소를 입력하세요!");
        document.member_form.email1.focus();
        return;
    }

    if (!document.member_form.email2.value) {
        alert("이메일 주소를 입력하세요!");
        document.member_form.email2.focus();
        return;
    }

    if (document.member_form.pass.value !=
        document.member_form.pass_confirm.value) {
        alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
        document.member_form.pass.focus();
        document.member_form.pass.select();
        return;
    }

    // 이름 유효성 검사 (2글자 이상, 한글 또는 영어)
    const nameRegex = /^[a-zA-Z가-힣]{2,}$/;
    if (!nameRegex.test(name)) {
       alert("이름은 2글자 이상의 한글 또는 영어로 입력하세요.");
       form.name.focus();
       return;
    }

    // 이메일 유효성 검사
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
       alert("유효한 이메일 주소를 입력하세요.");
       form.email1.focus();
       return;
    }

    document.member_form.submit();
}

function reset_form() {
    document.member_form.id.value = "";
    document.member_form.pass.value = "";
    document.member_form.pass_confirm.value = "";
    document.member_form.name.value = "";
    document.member_form.email1.value = "";
    document.member_form.email2.value = "";

    document.member_form.id.focus();

    return;
}
