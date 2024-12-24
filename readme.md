
# Job Offers Plugin for WordPress

The Job Offers plugin allows you to list, filter, and manage job offers on your WordPress site. It provides functionalities such as asynchronous pagination (AJAX), filtering by Technology and Location, and the ability to add, edit, and delete job offers. It also includes a redirect feature for job application and job offer detail pages.

## Features

- Job Offers List: Displays job offers with title, description, technology, and location.
- Pagination: Offers pagination with AJAX for seamless browsing.
- Asynchronous Filtering: Filters job offers based on Technology and Location without reloading the page.
- Job Offer Management: Admins can add, edit, or delete job offers.
- Job Application and Details Links: Redirects to a custom application form and job offer detail page.
## Requirements

- PHP version 8.3
- WordPress version 6.7.1 or higher
## Installation

Step 1: Download the Plugin
- Download the plugin as a .zip file or clone it from the repository on GitHub.
Step 2: Install the Plugin
- Go to your WordPress admin dashboard.
- Navigate to Plugins > Add New.
- Click on the Upload Plugin button.
- Select the .zip file you downloaded and click Install Now.
- After installation, click Activate to activate the plugin.
Step 3: Configure the Plugin
- Go to the Job Offers settings page in the WordPress admin.
- Here, you can configure the Technology and Location parameters for filtering.
- Setup shortcode on selected page.

## Plugin Structure

assets/: Contains the CSS and JavaScript files for the plugin.
- script.js: Contains the JavaScript to handle AJAX requests and pagination.
- style.css: Contains the CSS for styling the job offers and filter UI.
includes/: Contains PHP files that manage the core functionality of the plugin.
- ajax-handlers.php: Handles AJAX requests for pagination and filtering.
- custom-post-type.php: Registers the "Job Offer" custom post type.
- display-job-offers.php: Displays the job offers and handles the filtering UI.
- regenerate.php: Regenerates the job offers data if necessary.
- job-offers-plugin.php: The main plugin file that initializes and loads the necessary files.
## How to Use

```bash
- Viewing Job Offers: After activating the plugin, a list of job offers will be displayed on your site. The list will show 4 job offers per page, with pagination powered by AJAX.
- Filtering Job Offers: Use the filtering options for Technology and Location to narrow down the job offers. The filters will update the list without refreshing the page.
- Adding/Editing/Deleting Job Offers: Go to the Job Offers section in the WordPress admin to manage job offers.
- Job Application: Clicking the "Apply" button will redirect the user to a job application form.
- Job Details: Clicking the "Details" button will open the individual job offer page in a new tab.
```
    
## License

[MIT](https://choosealicense.com/licenses/mit/)

