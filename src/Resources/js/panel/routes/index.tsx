import { Routes, Route, Outlet, Link } from "react-router-dom";
import { Dashboard } from "../pages/dashboard";
import {Create as FolderCreate, Index as FolderIndex} from "../pages/folders";
export const Router = () => {
    return (
        <Routes>
            <Route path="/" element={<Dashboard />} />
            <Route path="/folders/:id" element={<FolderIndex />} />
        </Routes>
    );
}
