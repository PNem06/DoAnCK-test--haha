DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetActorsByMovie`(
    IN p_MovieID INT
)
BEGIN
    SELECT a.Actor_ID,
           a.Actor_Name,
           a.Actor_Info,
           a.Actor_Social
    FROM tbl_actor a
    INNER JOIN tbl_character c 
        ON a.Actor_ID = c.Actor_ID
    INNER JOIN tbl_movie m 
        ON c.Movie_ID = m.Movie_ID
    WHERE m.Movie_ID = p_MovieID;
END$$
DELIMITER ;
