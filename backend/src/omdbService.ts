import axios from "axios";
import dotenv from "dotenv";

dotenv.config();

const API_URL = "http://www.omdbapi.com/";
const API_KEY = process.env.OMDB_API_KEY;

export const fetchMovieByTitle = async (title: string) => {
    try {
        const response = await axios.get(API_URL, {
            params: { apikey: API_KEY, t: title },
        });
        return response.data;
    } catch (error) {
        throw new Error("Error fetching movie data");
    }
};
