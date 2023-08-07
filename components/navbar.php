<link rel="stylesheet" href="../components/navbar.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    const searchInput = $('#search-input');
    const searchDropdown = $('#search-dropdown'); 

    searchInput.on('input', function () {
      const searchTerm = searchInput.val().trim();
      if (searchTerm !== '') {
        $.ajax({
          type: 'GET',
          url: '../components/search.php', 
          data: { searchTerm: searchTerm },
          dataType: 'json',
          success: function (response) {
            updateDropdown(response);
          },
          error: function (xhr, status, error) {
            console.error('AJAX error:', status, error);
            console.log('XHR object:', xhr);
          }
        });
      } else {
        searchDropdown.html('');
      }
    });

    function updateDropdown(results) {
      searchDropdown.html('');
      if (results.length > 0) {
        results.forEach(result => {
          const option = $('<a>').attr('href', '../profile/index.php?uid='+result.uid).addClass('dropdown-option').text(result.name);
          searchDropdown.append(option);
        });
      } else {
        const noResults = $('<div>').addClass('no-results').text('No results found');
        searchDropdown.append(noResults);
      }
    }
  });
</script>


<nav>
    <div class="navbar">
      <div class="left-section-nav">
        <div class="logo">
          <a href="../home" class="logo-full"><img src="../img/logo_simple.png" alt="logo"></a>
          <a class="logo-small" href="#"><img src="../img/logo_small.png" alt="logo"></a>
        </div>
        <div class="search">
          <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="47" height="47" viewBox="0 0 47 47" fill="none">
            <path
              d="M22.2072 44.4143C9.96614 44.4143 0 34.4482 0 22.2072C0 9.96614 9.96614 0 22.2072 0C34.4482 0 44.4143 9.96614 44.4143 22.2072C44.4143 34.4482 34.4482 44.4143 22.2072 44.4143ZM22.2072 3.24983C11.7427 3.24983 3.24983 11.7644 3.24983 22.2072C3.24983 32.6499 11.7427 41.1645 22.2072 41.1645C32.6716 41.1645 41.1645 32.6499 41.1645 22.2072C41.1645 11.7644 32.6716 3.24983 22.2072 3.24983Z"
              fill="white" />
            <path
              d="M44.956 46.5802C44.5443 46.5802 44.1327 46.4286 43.8078 46.1036L39.4751 41.7709C38.8468 41.1427 38.8468 40.1028 39.4751 39.4746C40.1033 38.8464 41.1432 38.8464 41.7714 39.4746L46.1041 43.8073C46.7324 44.4355 46.7324 45.4754 46.1041 46.1036C45.7792 46.4286 45.3676 46.5802 44.956 46.5802Z"
              fill="white" />
          </svg>
          <input id="search-input" type="text">
          <div id="search-dropdown" class="search-dropdown"></div>
        </div>
      </div>
      <ul class="nav-links">

        <li><a href="../home"><svg class="icon" xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 55 55"
              fill="none">
              <path
                d="M41.8317 54.5575H13.1849C8.52974 54.5575 4.28385 50.9766 3.51652 46.3982L0.114699 26.0128C-0.448009 22.8412 1.11223 18.7743 3.64441 16.7536L21.3697 2.55807C24.797 -0.204317 30.1939 -0.178739 33.6469 2.58364L51.3722 16.7536C53.8788 18.7743 55.4134 22.8412 54.9019 26.0128L51.5 46.3726C50.7327 50.8999 46.3845 54.5575 41.8317 54.5575ZM27.4827 4.3485C26.127 4.3485 24.7714 4.75774 23.7739 5.55065L6.04871 19.7718C4.61636 20.9228 3.59326 23.583 3.90019 25.399L7.30201 45.7588C7.76241 48.4444 10.4481 50.7208 13.1849 50.7208H41.8317C44.5685 50.7208 47.2542 48.4444 47.7146 45.7332L51.1164 25.3734C51.3977 23.583 50.3746 20.8716 48.9679 19.7462L31.2426 5.57623C30.2195 4.75774 28.8383 4.3485 27.4827 4.3485Z"
                fill="white" />
            </svg></a></li>



        <li><a href="#"> <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="51" height="52" viewBox="0 0 51 52"
              fill="none">
              <path
                d="M17.3668 42.3H16.1848C6.72825 42.3 2 39.9359 2 28.1152V16.2946C2 6.83811 6.72825 2.10986 16.1848 2.10986H35.0978C44.5543 2.10986 49.2825 6.83811 49.2825 16.2946V28.1152C49.2825 37.5717 44.5543 42.3 35.0978 42.3H33.9157C33.1828 42.3 32.4736 42.6546 32.0244 43.2456L28.4782 47.9739C26.9179 50.0543 24.3646 50.0543 22.8043 47.9739L19.2581 43.2456C18.8799 42.7255 18.0051 42.3 17.3668 42.3Z"
                stroke="white" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
              <path d="M35.0889 23.387H35.1091" stroke="white" stroke-width="4.044" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M25.6304 23.387H25.6508" stroke="white" stroke-width="4.044" stroke-linecap="round"
                stroke-linejoin="round" />
              <path d="M16.1714 23.387H16.1918" stroke="white" stroke-width="4.044" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg></a></li>



        <li>
        <div class="notification-container">
          <button id="notification-btn">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52"
              fill="none">
              <path
                d="M42.4299 17.9281C37.4817 17.9281 33.4658 13.9122 33.4658 8.96406C33.4658 4.0159 37.4817 0 42.4299 0C47.378 0 51.3939 4.0159 51.3939 8.96406C51.3939 13.9122 47.378 17.9281 42.4299 17.9281ZM42.4299 3.58562C39.4658 3.58562 37.0514 5.99994 37.0514 8.96406C37.0514 11.9282 39.4658 14.3425 42.4299 14.3425C45.394 14.3425 47.8083 11.9282 47.8083 8.96406C47.8083 5.99994 45.394 3.58562 42.4299 3.58562Z"
                fill="white" />
              <path
                d="M25.697 29.8803H13.745C12.7649 29.8803 11.9521 29.0676 11.9521 28.0875C11.9521 27.1074 12.7649 26.2947 13.745 26.2947H25.697C26.6771 26.2947 27.4899 27.1074 27.4899 28.0875C27.4899 29.0676 26.6771 29.8803 25.697 29.8803Z"
                fill="white" />
              <path
                d="M35.2587 39.4421H13.745C12.7649 39.4421 11.9521 38.6293 11.9521 37.6493C11.9521 36.6692 12.7649 35.8564 13.745 35.8564H35.2587C36.2388 35.8564 37.0515 36.6692 37.0515 37.6493C37.0515 38.6293 36.2388 39.4421 35.2587 39.4421Z"
                fill="white" />
              <path
                d="M32.8682 51.3939H18.5257C5.54577 51.3939 0 45.8482 0 32.8682V18.5257C0 5.54577 5.54577 0 18.5257 0H30.4778C31.4579 0 32.2706 0.812741 32.2706 1.79281C32.2706 2.77288 31.4579 3.58562 30.4778 3.58562H18.5257C7.50591 3.58562 3.58562 7.50591 3.58562 18.5257V32.8682C3.58562 43.888 7.50591 47.8083 18.5257 47.8083H32.8682C43.888 47.8083 47.8083 43.888 47.8083 32.8682V20.9161C47.8083 19.9361 48.6211 19.1233 49.6011 19.1233C50.5812 19.1233 51.3939 19.9361 51.3939 20.9161V32.8682C51.3939 45.8482 45.8482 51.3939 32.8682 51.3939Z"
                fill="white" />
            </svg>
          </button>
          <div id="notification-dropdown" class="notification-dropdown">
            <!-- Your notifications will be dynamically added here -->
          </div>
        </div>

          <!-- <a href="../notifications">
        </a> -->
      </li>



        <li><a href="../logout.php"> <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 69 71" fill="none">
            <path d="M25.5875 22.365C26.4787 11.715 31.7975 7.36621 43.4412 7.36621H43.815C56.6662 7.36621 61.8125 12.6616 61.8125 25.8854V45.1737C61.8125 58.3975 56.6662 63.6929 43.815 63.6929H43.4412C31.8837 63.6929 26.565 59.4033 25.6162 48.9308M5.75 35.5H42.78" stroke="white" stroke-width="4.044" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M36.3687 25.5896L45.9999 35.5L36.3687 45.4104" stroke="white" stroke-width="4.044" stroke-linecap="round" stroke-linejoin="round"/>
        </svg></a></li>

      </ul>
    </div>
  </nav>
  <script src="../components/navbar.js"></script>
