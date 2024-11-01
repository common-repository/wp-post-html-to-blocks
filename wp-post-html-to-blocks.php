<?php
/*
Plugin Name: WP Post html to blocks
Plugin URI: http://www.zdatatech.com/plugins/wp-post-html-to-blocks
Description: Admin options to surround line space, p tag, and div tag content with html Gutenberg Blocks
Version: 1.2
Author: Zeshan
Author URI: http://zdatatech.com/about
Text Domain: WP-post-html-to-blocks
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

//stackoverflow undefined index https://stackoverflow.com/questions/4842759/php-undefined-index

if(is_admin()){

	/*Add Menu option for Admin*/
	add_action('admin_menu', 'wp_post_html_to_blocks_menu');

	function wp_post_html_to_blocks_menu(){
		add_options_page('WP Post HTML to Blocks', 'WP Post HTML To Blocks' ,'manage_options', 'wp-post-html-to-blocks-info-page','wp_post_html_to_block_config_page');
	}
	
	function PHTBM_surroundLineSpace($queryPostID, $queryPostStatus){
        global $wpdb;
		 
	    //query post id
		$PostsQuery = $wpdb->get_results("SELECT ID, post_title, post_content, post_status FROM $wpdb->posts WHERE ID = $queryPostID");
	
		foreach($PostsQuery as $post){
			
			//get post content
			$thePostContent = $post->post_content;
		
		
			$matchPtags = "/<p\b[^>]*>(.*?)<\/p>/si";
			
			
			$matchAlreadyExists = "/<!-- wp:html --\>/s";
		  
		    preg_match_all(''.$matchAlreadyExists.'',''.$thePostContent.'',$doesMatchExist,PREG_PATTERN_ORDER);
		  
		    if(!(count($doesMatchExist[0]) >= 1)){
			  
			    $thePostContent = preg_replace_callback(
					$matchPtags,
					function($m){
						
						
					return '<!-- wp:html -->
						'.$m[1].'
					<!-- /wp:html -->
					
					';
						
					},

			    $thePostContent
              
				); //end preg_replace_callback, replace Line Space
			
		 
            //prepare and update post using post id
	        $PostsQuery = $wpdb->query( $wpdb->prepare(" UPDATE $wpdb->posts SET post_content = %s WHERE ID = %d AND post_status = %s", $thePostContent, $queryPostID,  $queryPostStatus )); 
		   
		     echo "".$PostsQuery." Post is processed <br />";
			  
			}else{
			  
			 echo " This Post is already processed <br />";
			  
		    }// end else if
		 
	
	    } //end foreach

		
	} //close replace Line Space
	
	
	//Encapsulate P tag with HTML blocks
	function PHTBM_surroundPtags($queryPostID, $queryPostStatus){
        global $wpdb;
		 
	    //query post id
		$PostsQuery = $wpdb->get_results("SELECT ID, post_title, post_content, post_status FROM $wpdb->posts WHERE ID = $queryPostID");
	
		foreach($PostsQuery as $post){
			
			//get post content
			$thePostContent = $post->post_content;

			$matchPtags = "/(.*?)$/m";
			
			
			$matchAlreadyExists = "/<!-- wp:html --\>/s";
		  
		  preg_match_all(''.$matchAlreadyExists.'',''.$thePostContent.'',$doesMatchExist,PREG_PATTERN_ORDER);
		  
		    if(!(count($doesMatchExist[0]) >= 1)){
			  
			  $thePostContent = preg_replace_callback(
				$matchPtags,
				function($m){
					
					
				return '<!-- wp:html -->
				<p>'.$m[1].'</p>
				<!-- /wp:html -->
				
				';
					
				},

			     $thePostContent
              
				); //end preg_replace_callback, surround p tags
			
		 
            //prepare and update post using post id
	        $PostsQuery = $wpdb->query( $wpdb->prepare(" UPDATE $wpdb->posts SET post_content = %s WHERE ID = %d AND post_status = %s", $thePostContent, $queryPostID,  $queryPostStatus )); 
		   
		     echo "".$PostsQuery." Post is processed <br />";
			  
			}else{
			  
			 echo " This Post is already processed <br />";
			  
		    }// end else if
		 
	
	    } //end foreach

	} //close surround p tags
	
	//Encapsulate div tags with HTML blocks
	function PHTBM_surroundDivTags($queryPostID, $queryPostStatus){
        
		global $wpdb;
		 
	    //query post id
		$PostsQuery = $wpdb->get_results("SELECT ID, post_title, post_content, post_status FROM $wpdb->posts WHERE ID = $queryPostID");
	
		foreach($PostsQuery as $post){
			
			//get post content
			$thePostContent = $post->post_content;
		
			$matchPtags = "/<div\b>(.*?)<.div\b>/s";
			
			$matchAlreadyExists = "/<!-- wp:html --\>/s";
		  
		  preg_match_all(''.$matchAlreadyExists.'',''.$thePostContent.'',$doesMatchExist,PREG_PATTERN_ORDER);
		  
		    if(!(count($doesMatchExist[0]) >= 1)){
			  
			  $thePostContent = preg_replace_callback(
				$matchPtags,
				function($m){
	
				return '<!-- wp:html -->
				<div>'.$m[1].'</div>
				<!-- /wp:html -->
				
				';
					
				},

			     $thePostContent
              
				); //end preg_replace_callback, surround div tags
			
		 
        //prepare and update post using post id
	    $PostsQuery = $wpdb->query( $wpdb->prepare(" UPDATE $wpdb->posts SET post_content = %s WHERE ID = %d AND post_status = %s", $thePostContent, $queryPostID,  $queryPostStatus )); 
		   
		     echo "".$PostsQuery." Post is processed <br />";
			  
			}else{
			  
			 echo " This Post is already processed <br />";
			  
		    }// end else if
		 
	    } //end foreach

	} //close surround div tags
	
	//Encapsulate div tags with HTML blocks
	function PHTBM_surroundBrTags($queryPostID, $queryPostStatus){
        global $wpdb;
		 
	    //query post id
		$PostsQuery = $wpdb->get_results("SELECT ID, post_title, post_content, post_status FROM $wpdb->posts WHERE ID = $queryPostID");
	
		foreach($PostsQuery as $post){
			
			//get post content
			$thePostContent = $post->post_content;
		
			$matchPtags = "/(.*?)<\w+ \/>/";
			
			$matchAlreadyExists = "/<!-- wp:html --\>/s";
		  
		  preg_match_all(''.$matchAlreadyExists.'',''.$thePostContent.'',$doesMatchExist,PREG_PATTERN_ORDER);
		  
		  if(!(count($doesMatchExist[0]) >= 1)){
			  
			  $thePostContent = preg_replace_callback(
				$matchPtags,
				function($m){
					
					
				return '<!-- wp:html -->
				    '.$m[1].'
				<!-- /wp:html -->
				
				';
					
				},

			     $thePostContent
              
				); //end preg_replace_callback
			
		 
      //prepare and update post using post id
	  $PostsQuery = $wpdb->query( $wpdb->prepare(" UPDATE $wpdb->posts SET post_content = %s
		   WHERE ID = %d AND post_status = %s", $thePostContent, $queryPostID,  $queryPostStatus )); 
		   
		     echo "".$PostsQuery." Post is processed <br />";
			  
			  }else{
			  
			 echo " This Post is already processed <br />";
			  
		  }// end else if
		 
	
	  } //end foreach

	} //close surround div tags
	
//Display config page in admin dashboard
function wp_post_html_to_block_config_page(){
       global $wpdb;
	 
	    $PostsQuery = (isset($PostsQuery) ? $PostsQuery : null);
	    $RequestSent = sanitize_text_field((isset($_POST['RequestSent']) ? $_POST['RequestSent'] : null));
	    $topPosts = sanitize_text_field((isset($_POST['topPosts']) ? $_POST['topPosts'] : 1));
	    $queryPostID = sanitize_text_field((isset($_POST['queryPostID']) ? $_POST['queryPostID'] : null)); 
        $queryPostStatus = sanitize_text_field((isset($_POST['queryPostStatus']) ? $_POST['queryPostStatus'] : null));
        $htmlSurroundTag = sanitize_text_field((isset($_POST['htmlSurroundTag']) ? $_POST['htmlSurroundTag'] : null));
		$SearchPosts = sanitize_text_field((isset($_POST['SearchPosts']) ? $_POST['SearchPosts'] : null));
	 
	//if run query button pressed..to prevent performance tax on a wordpress install
    if(isset($RequestSent) && isset($topPosts)){
	
		
		if(isset($SearchPosts)){
	
			
		  $PostsQuery = $wpdb->get_results("SELECT ID, post_title, post_content, post_status FROM $wpdb->posts WHERE post_title LIKE '%$SearchPosts%' LIMIT $topPosts;");

          
			
		}//close if set
		
		
		if(!isset($SearchPosts)){
			
		  $PostsQuery = $wpdb->get_results("SELECT ID, post_title, post_content, post_status FROM $wpdb->posts LIMIT $topPosts;");	
			
		}//close if not set
		
		
	}//form self post
	

?>	

   <div style="background_color:#c3c4c7">
	<h2>About WP Post HTML to Blocks</h2>
	
	<p>For markup that is copy pasted into <strong>Gutenberg editor classic block</strong>. Purpose of this plugin is to allow a <strong>Wordpress publisher administrator</strong> to manually <strong>surround html tags</strong> such as p, div, br <strong>for interpretation</strong> by Gutenberg editor <strong>as html blocks.</strong></p>
	
	<?php
	   if(isset($queryPostID) && isset($queryPostStatus) && isset($htmlSurroundTag)){
		
		
		  switch($htmlSurroundTag){
			  
			  case "LineSpace":
			     
				 PHTBM_surroundLineSpace($queryPostID, $queryPostStatus);
				 
				   //var_dump($PostsQuery);
				   echo "<strong>Looked through content for post id ".$queryPostID." after button press.</strong>";
			  
			  break;
			  case "p":
			  
			     PHTBM_surroundPtags($queryPostID, $queryPostStatus);
		   
				   //var_dump($PostsQuery);
				   echo "<strong>Looked through  for post id ".$queryPostID." after button press.</strong>";
				   
			  break;
			  case "div":
			  
			     PHTBM_surroundDivTags($queryPostID, $queryPostStatus);
		   
				   //var_dump($PostsQuery);
				   echo "<strong>Looked through  for post id ".$queryPostID." after button press.</strong>";
			  
			  break;
			  case "br":
			  
			     PHTBM_surroundBrTags($queryPostID, $queryPostStatus);
		   
				   //var_dump($PostsQuery);
				   echo "<strong>Looked through  for post id ".$queryPostID." after button press.</strong>";
			  
			  break;

		  }
		
	   }//end notify user of button press
	
	?>
	
	<div>
	  
	    <form target="_self" method="post">
		  <div class="media-toolbar-primary search-form">
		  
	      <label> Search</label>
		    <input type="search" name="SearchPosts"  placeholder="Terms from Post Titles"  value="<?php if(isset($SearchPosts)){echo $SearchPosts;} ?>"/> 
	      <label> Top</label> 
		  <select name="topPosts" id="bulk-action-selector-bottom" class="postform">	
			<option value="1" selected=selected>1</option>
			<option value="5" >5</option>
			<option value="10" >10</option>
			<option value="15" >15</option>
			<option value="25" >25</option>
			<option value="30" >30</option>
		  </select>
		     <button class="button media-button"  >Search</button>
				  <input type="hidden" name="RequestSent" value="RequestingPosts" />
				
		   </div>
		 </form>  
		 <?php
             if($PostsQuery){
          ?>		 
		  
		  <table class="wp-list-table widefat fixed striped posts">
		   <thead>
		     <tr >
			     <th> ID</th>
			     <th >Title</th>
				 <th >Status</th>
				 <th >Seek HTML Tag</th>
				 <th>Surround HTML Tags with Blocks</th>
			 </tr>
		    </thead>
			<tbody>
			 <?php
			    foreach($PostsQuery as $QuriedPosts){
					
			 ?>
			  <tr>
			   <form target="_self" method="post">
			      <td ><?php echo $QuriedPosts->ID ?></td>
			      <td ><?php echo $QuriedPosts->post_title ?></td>
				  <td ><strong><?php echo $QuriedPosts->post_status ?></strong></td>
				  <td >
				    <select name="htmlSurroundTag" id="bulk-action-selector-top">
					    <option value="LineSpace">Lines With Space (\n)</option>
						<option value="p" selected=selected>&lt;p&gt;&lt;/p&gt;</option>
						<option value="div" >&lt;div&gt;&lt;/div&gt;</option>
						<option value="br" >&lt;br &frasl;&gt;</option>
					 </select>
				  </td>
				  <td>
				   <button class="button action">Encapsulate HTML tag</button>
				  <input type="hidden" name="queryPostID" value="<?php echo $QuriedPosts->ID ?>" /> 
                  <input type="hidden" name="queryPostStatus" value="<?php echo $QuriedPosts->post_status ?>" />  
				  </td>
			    </form>
			  </tr>  
			</tbody>	
		    <?php
			    } //close foreach
			
	        ?>
			<tfoot>
		     <tr >
			     <th>ID</th>
			     <th>Title</th>
				 <th>Status</th>
				 <th>Seek HTML Tag</th>
				 <th>Surround HTML Tags with Blocks</th>
			 </tr>
		    </tfoot>
		  </table>
		 
		<?php
			 } //close if post
		?>		 
	  
	
	</div>
 </div><!-- close welcome-panel -->

<?php
	}
}
?>