          function closeNav() {
			document.getElementById("mySidenav").style.width = "50px";
			$('.content').css('margin-left', '50px');
			$('.collapse1').css('left', '0');
			$('#toggle').html('<span style="font-size:30px;cursor:pointer; color: white;" onclick="openNav()">&#9776;</span>');
		  }
		  function openNav() {
			document.getElementById("mySidenav").style.width = "150px";
			$('.collapse1').css('left', '0');
			$('#toggle').html('<span style="font-size:30px;cursor:pointer; color: white;" onclick="closeNav()">&#9776;</span>');
			$('.content').css('margin-left', '150px');
		  }