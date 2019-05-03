/* Select customers where the username and password match those passed as parameters */
select *
from users 
where
    email = :email 