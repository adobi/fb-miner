
			</div> <!-- content -->
			
		    <?php if ($this->session->userdata('current_user_id')): ?>
		        
        		<div id="footer" class = "span-24">
        		</div> <!-- footer -->
    		
		    <?php endif ?>
		</div> <!-- container -->
		<?php if ($this->session->userdata('current_user_id')): ?>
		    
            <div id="loading-global">Please wait...</div>
		<?php endif ?>
		
	</body>

</html>
