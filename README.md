# Evaluation System

>This is a web application for employee evaluation.  

### Features
- In this project have 3 user type and each user type has difference ability to do:
    - **Employee**
        - Employee user can evaluate other user if the system is open 
        - Can see the summary of thier own evaluation result
    - **Manager** 
        - (Pending Request)
    - **Director** 
        - (Approve Request)

- The system is open for evaluate only 2 weeks after the end of each quarter.  
    > - Quarter 1 : 1-14 April
    > - Quarter 2 : 1-14 July
    > - Quarter 3 : 1-14 October
    > - Quarter 4 : 1-14 January (next year)
- Unit test ...

## Framework/Tool
* [Codeigniter](https://codeigniter.com/)
* [Bootstrap 4](https://getbootstrap.com/)
* [Jquery](https://jquery.com/)
* [Chart.js](https://www.chartjs.org/)
* [Composer](https://getcomposer.org)

## Installation
1. Clone this project to local destination
2. Create database by using file **evaluation-system.sql** 
3. Open the address of the location file project

>If you want to change a database config then go to `application/config/database.php` and update

## Notes
- In this project use the current dates but you can change dates for testing. Go to `application/config/constants.php` and change value of `$GLOBALS['date']`  

**Default:**
```
$GLOBALS['date'] = array('date' => date('d'),
                         'month' => date('m',time()),
                         'year' => date('Y'));
```
