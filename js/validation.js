function iseformValidation(){

	var ise_type = document.addForm.ise_type;
	var ise_name = document.addForm.ise_name;
	
	if(ise_type.value==''){
		alert('Please Select Type.');
		ise_type.focus();
		return false;
	}
	if(ise_name.value==''){
		alert('Please Enter Name.');
		ise_name.focus();
		return false;
	}
	
	return true;
}