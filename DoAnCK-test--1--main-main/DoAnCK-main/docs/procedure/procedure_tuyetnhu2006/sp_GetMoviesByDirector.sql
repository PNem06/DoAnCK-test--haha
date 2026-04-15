DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetMoviesByDirector`(IN `p_DirectorID` INT)
BEGIN
    SELECT m.Movie_ID,
           m.Movie_Title,
           m.Movie_ReleaseDate,
           m.Movie_Img
    FROM tbl_movie m
    INNER JOIN `tbl_movie-director` md 
        ON m.Movie_ID = md.Movie_ID
    WHERE md.Director_ID = p_DirectorID;
END$$
DELIMITER ;
