CREATE PROCEDURE sp_GetMoviesByGenre(IN pGenreID INT)
BEGIN
   SELECT m.*, g.Genre_Name
   FROM tbl_movie m
   JOIN tbl_genre g
   ON m.Genre_ID = g.Genre_ID
   WHERE m.Genre_ID = pGenreID;
END
