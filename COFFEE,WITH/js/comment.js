const isLoggedIn = <?= isset($userid) && $userid !== "" ? 'true' : 'false' ?>;

		function checkLogin() {
			if (!isLoggedIn) {
				alert('로그인 후 이용해 주세요!');
				return false;
			}
			return true;
		}