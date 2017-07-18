function fetch_name(str) {
		        if (str.length == 0) {
		        document.getElementById("christian_name").value = "";
		        return;
		    } else {
		        var xmlhttp = new XMLHttpRequest();
		        xmlhttp.onreadystatechange = function() {
		            if (this.readyState == 4 && this.status == 200) {
		                document.getElementById("christian_name").value = this.responseText;
		            }
		        };
		        xmlhttp.open("GET", "sp_controller.php?q=" + str, true);
		        xmlhttp.send();
		    }
		}
		function update_rpt_notification(){
			var mzg = document.getElementById('fin_year_id_year').value;
			var dateOfToday = new Date();
			var yearOfToday = dateOfToday.getFullYear();
			if (mzg != 0) {
				// alert('We are good to go');
				//check if it is the current year in order to know how to proceed with the download
				document.getElementById('saveImage').disabled = false;
				document.getElementById('anual_rpt_notification').innerHTML = 'YOU ARE NOW ABOUT TO PRINT FINANCIAL REPORT FOR THE YEAR '+mzg;
				document.getElementById('anual_rpt_notification').style.color = "blue";
				// document.getElementById().disabled = true;
			}
		}
		function update_rpt_notification2(){
			var mzg = document.getElementById('fin_year_qtr').value;
			//check for year if it is not current year
			var todayDate = new Date();
			var year = todayDate.getFullYear();
			var month = todayDate.getMonth();
			if (mzg != year) {
				//the year is not the current year so we go the year in question
				document.getElementById('hidden_select_qtr_div').removeAttribute('hidden');
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT QUATER FINANCIAL REPORT FOR THE YEAR '+mzg;
				document.getElementById('anual_rpt_notification2').style.color = "blue";
			}
			else{
				//it is the current year
				document.getElementById('hidden_select_qtr_div').removeAttribute('hidden');
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT QUATER FINANCIAL REPORT FOR THE YEAR '+mzg;
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled property
			}
		}
		function update_rpt_notification3(){
			var desired_quater = document.getElementById('quater_id').value;
			var year = document.getElementById('fin_year_qtr').value;
			if (desired_quater == 1) {
				// alert('I am here Now So');
				document.getElementById('save_Image').disabled = false;
				document.getElementById('anual_rpt_notification3').innerHTML = 'YOU ARE NOW ABOUT TO PRINT 1ST QUATER FINANCIAL REPORT FOR THE YEAR '+year ;
				document.getElementById('anual_rpt_notification3').style.color = "blue";
			}
			else if (desired_quater == 2) {
				document.getElementById('save_Image').disabled = false;
				document.getElementById('anual_rpt_notification3').innerHTML = 'YOU ARE NOW ABOUT TO PRINT 2ND QUATER FINANCIAL REPORT FOR THE YEAR '+year;
				document.getElementById('anual_rpt_notification3').style.color = "blue";
				//remove disabled property
			}
			else if (desired_quater == 3) {
				document.getElementById('save_Image').disabled = false;
				document.getElementById('anual_rpt_notification3').innerHTML = 'YOU ARE NOW ABOUT TO PRINT 3RD QUATER FINANCIAL REPORT FOR THE YEAR '+year;
				document.getElementById('anual_rpt_notification3').style.color = "blue";
				//remove disabled property
			}
			else if (desired_quater == 4) {
				document.getElementById('save_Image').disabled = false;
				document.getElementById('anual_rpt_notification3').innerHTML = 'YOU ARE NOW ABOUT TO PRINT 4TH QUATER FINANCIAL REPORT FOR THE YEAR '+year;
				document.getElementById('anual_rpt_notification3').style.color = "blue";
				//remove disabled proper
			}
			else{
				alert('You must Select a quater between 1 and 4');	
			}
		}
		function monthly_update_rpt_notification(){
			var mzg = document.getElementById('fin_year_id2_month').value;
			//check for year if it is not current year
			var todayDate = new Date();
			var year = todayDate.getFullYear();
			var month = todayDate.getMonth();
			if (mzg != year) {
				//the year is not the current year so we go the year in question
				document.getElementById('hidden_select_div').removeAttribute('hidden');
				
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT MONTHLY FINANCIAL REPORT FOR THE YEAR '+mzg;
				document.getElementById('anual_rpt_notification2').style.color = "blue";
			}
			else{
				//it is the current year
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT MONTHLY FINANCIAL REPORT FOR THE YEAR '+mzg;
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled property
			}
		}
		function monthly2_update_rpt_notification(){
			var desired_month = document.getElementById('selected_month_id').value;
			// var year = document.getElementById('fin_year_id2').value;
			if (desired_month == 'Jan') {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT JANUARY FINANCIAL REPORT FOR THE SELECTED YEAR ' ;
				document.getElementById('anual_rpt_notification2').style.color = "blue";
			}
			else if (desired_month == 'Feb') {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT FEBRUARY FINANCIAL REPORT FOR THE SELECTED YEAR ';
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled property
			}
			else if (desired_month == 'Mar') {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT MARCH FINANCIAL REPORT FOR THE SELECTED YEAR ';
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled property
			}
			else if (desired_month == 'Apr') {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT APRIL FINANCIAL REPORT FOR THE SELECTED YEAR ';
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled proper
			}
			else if (desired_month == 'May') {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT MAY FINANCIAL REPORT FOR THE SELECTED YEAR ';
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled proper
			}
			else if (desired_month == 'Jun') {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT JUNE FINANCIAL REPORT FOR THE SELECTED YEAR ';
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled proper
			}
			else if (desired_month == 'Jul') {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT JULY FINANCIAL REPORT FOR THE SELECTED YEAR ';
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled proper
			}
			else if (desired_month == 'Aug') {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT AUGUST FINANCIAL REPORT FOR THE SELECTED YEAR ';
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled proper
			}
			else if (desired_month == 'Sep') {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT SEPTEMBER FINANCIAL REPORT FOR SELECTED THE YEAR ';
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled proper
			}
			else if (desired_month == 'Oct') {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT OCTOBER FINANCIAL REPORT FOR THE SELECTED YEAR ';
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled proper
			}
			else if (desired_month == 'Nov') {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT NOVEMBER FINANCIAL REPORT FOR THE SELECTED YEAR ';
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled proper
			}
			else if (desired_month == 'Dec') {
				document.getElementById('saveImage2').disabled = false;
				document.getElementById('anual_rpt_notification2').innerHTML = 'YOU ARE NOW ABOUT TO PRINT DECEMBER FINANCIAL REPORT FOR THE SELECTED YEAR ';
				document.getElementById('anual_rpt_notification2').style.color = "blue";
				//remove disabled proper
			}
			else{
				alert('You must Select a Month Between Jan and Dec');	
			}
		}
		function offerings_view(){
			var optn = document.getElementById('motif').value;
			if (optn == 'Harvest' || optn == 'Offerings') {
				document.getElementById('christian_id').removeAttribute('required');
				document.getElementById('christian_id_grp').setAttribute('hidden','true');
				document.getElementById('christian_name_grp').setAttribute('hidden','true');
				document.getElementById('comment').removeAttribute('required');
			}
			else if(optn == 'Others'){
				document.getElementById('christian_id').removeAttribute('required');
				document.getElementById('christian_id_grp').setAttribute('hidden','true');
				document.getElementById('christian_name_grp').setAttribute('hidden','true');
				document.getElementById('comment_grp').removeAttribute('hidden');
				// document.getElementById('comment').setAttribute('required', 'true');
			}
			else if (optn == 'Project') {
				document.getElementById('christian_id').removeAttribute('required');
				document.getElementById('christian_id_grp').removeAttribute('hidden');
				document.getElementById('christian_name_grp').removeAttribute('hidden');
				document.getElementById('comment_grp').setAttribute('hidden', 'true');
				document.getElementById('comment').removeAttribute('required');
			}
			else{
				window.location = '..//pages/operations.php';
			}
		}
		function download_qreport(){
			//need to take year and quater as argument as argument
			window.location.href = 'http://localhost/MBC/quater_report.php';
		}