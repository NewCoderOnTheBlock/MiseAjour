var elt;
					
function apparait(height)
{
	if(height <= 25)
	{
		elt.style.height = height + "px";
		window.setTimeout(function() { apparait(height + 4); }, 10);
	}
}


function disparait(height)
{
	if(height > 0)
	{
		elt.style.height = height + "px";
		window.setTimeout(function() { disparait(height - 4); }, 10);
	}
	else
		elt.style.display = "none";
}


function affiche_bulle(id)
{
	elt = document.getElementById(id);
	elt.style.display = "block";
	apparait(0);
}


function efface_bulle(id)
{
	disparait(25);
}
					