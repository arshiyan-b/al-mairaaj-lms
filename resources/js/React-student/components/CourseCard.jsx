import { Button } from "@/components/ui/button";
import { CalendarDays, Play } from "lucide-react";
import { motion } from "framer-motion";

const CourseCard = ({ image, title, instructor, date, time, progress }) => {
  return (
    <motion.div
      whileHover={{ scale: 1.03, boxShadow: "0px 8px 20px rgba(0,0,0,0.15)" }}
      className="bg-white rounded-xl shadow-md overflow-hidden border transition flex flex-col"
    >
      {/* Image with progress badge */}
      <div className="relative">
        <img
          src={image}
          alt={title}
          className="w-full h-36 object-cover"
        />
        <div className="absolute top-2 right-2 bg-white/90 text-xs font-medium px-2 py-1 rounded-md shadow">
          {progress}% Complete
        </div>
      </div>

      {/* Card content */}
      <div className="p-4 flex flex-col justify-between flex-grow">
        <div>
          <h3 className="text-lg font-bold leading-snug line-clamp-2">{title}</h3>
          <p className="text-gray-600 text-sm mb-3">{instructor}</p>

          {/* Progress Bar */}
          <div className="w-full h-1.5 bg-gray-200 rounded-full mb-4">
            <div
              className="h-1.5 bg-teal-600 rounded-full"
              style={{ width: `${progress}%` }}
            ></div>
          </div>
        </div>

        {/* Footer row */}
        <div className="flex justify-between items-center text-sm text-gray-600 mt-auto">
          <div className="flex items-center gap-1">
            <CalendarDays className="w-4 h-4" />
            <span className="truncate">{date}, {time}</span>
          </div>
          <Button
            size="sm"
            className="rounded-full bg-green-600 hover:bg-green-700 text-white transition flex items-center gap-1"
          >
            <Play className="w-4 h-4" /> Resume
          </Button>
        </div>
      </div>
    </motion.div>
  );
};

export default CourseCard;
