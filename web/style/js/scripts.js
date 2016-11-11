/* ------- MENU ------- */
$(document).ready(function(){
ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
});
/* ------- TWITTER ------- */

getTwitters('twitter', {
        id: 'elemisdesign', 
        count: 1, 
        enableLinks: true, 
        ignoreReplies: false,
        template: '<span class="twitterPrefix"><span class="twitterStatus">%text% <em class="twitterTime"><a href="http://twitter.com/%user_screen_name%/statuses/%id%">- %time%</a></em></span> <br /><span class="username">@ <a href="http://twitter.com/%user_screen_name%/statuses/%id%">%user_screen_name%</a></span>',
        newwindow: true
    });

