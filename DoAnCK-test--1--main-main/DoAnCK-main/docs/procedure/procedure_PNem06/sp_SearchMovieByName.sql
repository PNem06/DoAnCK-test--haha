CREATE PROCEDURE sp_SearchMovieByName(IN keyword VARCHAR(128))
BEGIN
    SELECT * 
    FROM tbl_movie
    WHERE Movie_Title LIKE CONCAT('%', keyword, '%');
END
