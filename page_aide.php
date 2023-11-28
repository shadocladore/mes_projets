<!-------------------------- Page d'aide ---------------------------->
		<div id="bloc_aide">
			<div class="besoin">
				<img src="images/direction.png" width="25" height="15" class="direction"/>
				<h3>BESOIN D'AIDE ?</h3>
				<p><a href="#">Comment ajouter un employé dans la base de donnée de l'entreprise ?</a><p>
				<p><a href="#">Comment ajouter un employé dans la fiche des absences ?</a></p>
				<p><a href="#">Comment concevoir une demande d'autorisation d'absence ou de congé d'un employé ?</a></p>
				<p><a href="#">Comment ajouter un employé dans la liste des congés ?</a></p>
				<p><a href="#">Comment ajouter un employé dans la fiche de pointages journaliers ?</a></p>
			</div>
			<div class="numero">
				<p><img src="images/phone.png" width="30" height="40" class="phone"/></p>
				<p class="para">Appelez moi au <i><a href="tel:+237653025600">+237 653 02 56 00</a></i><br/><span>( du lun. au ven. de 10h à 16h)</span></p>
			</div>
		</div>
		<script type="text/javascript">
			/* Masquer et aficher le bloc d'aide */
			var aide = document.getElementById('aide');
			var bloc_aide = document.getElementById('bloc_aide');
			aide.onclick = function() {
				if(bloc_aide.style.transform=="scale(1)") {
    		    bloc_aide.style.transform="scale(0)";
    			} else {
				bloc_aide.style.zIndex="6"; 
       			 bloc_aide.style.transform="scale(1)";
    			}
			}
		</script>