import express, { Request, Response } from "express";
import { fetchMovieByTitle } from "./omdbService";

const router = express.Router();

router.get("/movie", async (req: Request, res: Response): Promise<void> => {
  const title = req.query.title?.toString();
  if (!title) {
    res.status(400).json({ error: "Title is required" });
    return;
  }
  try {
    const movie = await fetchMovieByTitle(title);
    res.json(movie);
  } catch (error) {
    console.error("Error fetching movie:", error);
    res.status(500).json({ error: "Failed to fetch movie data", details: (error as Error).message });
  }
});

export default router;
