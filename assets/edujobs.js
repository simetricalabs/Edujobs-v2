function gotopage(selval){
	var value = selval.options[selval.selectedIndex].value;
	window.location.href=value;
}

function enable_othersubjects_text_text(status)
{
	status=!status;	
	document.edujobspost.subject_othersubjects_text.disabled = status;
}

function enable_othergrades_text_text(status)
{
	status=!status;	
	document.edujobspost.grade_othercategories_text.disabled = status;
}

function enable_cv_othersubjects_text_text(status)
{
	status=!status;	
	document.educvpost.cv_subject_othersubjects_text.disabled = status;
}

function enable_cv_othergrades_text_text(status)
{
	status=!status;	
	document.educvpost.cv_grade_othercategories_text.disabled = status;
}

function enable_cvwe_othersubjects_text_text(status)
{
	status=!status;	
	document.educvpost.cvwe_subject_othersubjects_text.disabled = status;
}

function enable_cvwe_othergrades_text_text(status)
{
	status=!status;	
	document.educvpost.cvwe_grade_othercategories_text.disabled = status;
}


  $(function() {
    $( "#accordion" ).accordion();
  });

