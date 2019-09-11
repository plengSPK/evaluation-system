# Evaluation System

>This is a web application for employee evaluation.  

### Features
- In this project have 4 department 
  - Marketing
  - Human Resource Management
  - Accounting and Finance
  - Developer
  
- 3 user type and each type has different ability to do:
    - **Employee**
        - Employee user can evaluate other user in the same department if the system is open 
        - Can see the summary of thier own evaluation result
        - *Example user:*
				
            | Email  | Password | Department |
            | ------------- | ------------- | ------------- |
            | nicole@mail.com  | 0123456789  | Developer  |
            | sara@mail.com  | 0123456789  | Developer  |
            | harper@mail.com  | 0123456789  | Marketing  |

    - **Manager** 
        - Manager can see employees in the manager's department 
        - Can see the list of employees evaluation with status to know who was complete evaluated
        - Can see the summary evaluation result of each employee 
        - Can select any employee who should request for the new salary to the director with a overall summary evalution of the employee
        - Can see the result of request is approved or not. If the request is rejected the manager can see the reason
        - *Example user:*
				
            | Email  | Password | Department |
            | ------------- | ------------- | ------------- |
            | ava@mail.com  | 0123456789  | Developer  |

    - **Director** 
        - Can see the list of request for the new salary and choose to approves the request or not
        - Can see the history of request with status
        - *Example user:*
				
            | Email  | Password | Department |
            | ------------- | ------------- | ------------- |
            | ren@mail.com  | 0123456789  | Developer  |

- The system is open for evaluate only 2 weeks after the end of each quarter.  
    > - Quarter 1 : 1-14 April
    > - Quarter 2 : 1-14 July
    > - Quarter 3 : 1-14 October
    > - Quarter 4 : 1-14 January (next year)

- The unit test in this project have 4 case and located in  `{localPath}/evaluation-system/testcase/testcase{1-4}`
    > - You can select testcase from 1 to 4  

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
- In this project using the current dates but you can change dates for testing. Go to `application/config/constants.php` and change value of `$GLOBALS['date']`  

**Default:**
```
$GLOBALS['date'] = array('date' => date('d'),
                         'month' => date('m',time()),
                         'year' => date('Y'));
```
