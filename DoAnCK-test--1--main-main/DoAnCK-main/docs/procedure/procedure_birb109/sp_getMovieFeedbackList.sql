DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getMovieFeedbackList`(IN `Movie_ID` INT(10) ZEROFILL)
BEGIN
    SELECT 
        f.Feedback_ID,
        f.Feedback_Date, 
        f.Feedback_Data, 
        f.Account_ID,
        a.Username
    FROM tbl_feedback f
    JOIN tbl_account a 
        ON f.Account_ID = a.Account_ID
    WHERE f.Movie_ID = Movie_ID
    ORDER BY f.Feedback_Date DESC;
END$$
DELIMITER ;
