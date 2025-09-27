import { Tabs, TabsContent, TabsList, TabsTrigger } from "@/components/ui/tabs";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import { BookOpen, Clock, Users } from "lucide-react";
import { cn } from "@/lib/utils";

const Boardstabs = ({ boards }) => {
  const boardKeys = Object.keys(boards);

  const getBoardColors = (color) => {
    const colorMap = {
      edexcel: { bg: "bg-gradient-to-br from-edexcel to-edexcel-light", border: "border-edexcel/20" },
      aku: { bg: "bg-gradient-to-br from-aku to-aku-light", border: "border-aku/20" },
      cambridge: { bg: "bg-gradient-to-br from-cambridge to-cambridge-light", border: "border-cambridge/20" },
      ib: { bg: "bg-gradient-to-br from-ib to-ib-light", border: "border-ib/20" },
    };
    return colorMap[color] || colorMap.edexcel;
  };

  return (
    <Tabs defaultValue={boardKeys[0]} className="w-full">
      <TabsList className="grid w-full grid-cols-4 mb-8">
        {boardKeys.map((boardKey) => {
          const board = boards[boardKey];
          return (
            <TabsTrigger 
              key={boardKey} 
              value={boardKey}
              className="text-sm font-medium"
            >
              {board.title}
            </TabsTrigger>
          );
        })}
      </TabsList>

      {boardKeys.map((boardKey) => {
        const board = boards[boardKey];
        const colors = getBoardColors(board.color);
        
        return (
          <TabsContent key={boardKey} value={boardKey} className="space-y-6">
            {/* Board Header */}
            <div className={cn("rounded-xl p-6 text-white", colors.bg)}>
              <div className="flex justify-between items-start">
                <div>
                  <h2 className="text-2xl font-bold mb-2">{board.title}</h2>
                  <p className="text-white/90 text-lg">{board.description}</p>
                </div>
                <Badge variant="secondary" className="bg-white/20 text-white border-white/30">
                  {board.courses.length} Courses
                </Badge>
              </div>
            </div>

            {/* Courses Grid */}
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              {board.courses.map((course) => (
                <div
                  key={course.id}
                  className={cn(
                    "rounded-lg border bg-card p-6 transition-all duration-200 hover:shadow-lg",
                    colors.border
                  )}
                >
                  <div className="flex justify-between items-start mb-3">
                    <h3 className="font-semibold text-foreground text-lg">{course.title}</h3>
                    <Badge variant="outline" className="text-xs">
                      {course.level}
                    </Badge>
                  </div>
                  
                  <p className="text-sm text-muted-foreground mb-4 line-clamp-3">
                    {course.description}
                  </p>
                  
                  <div className="flex items-center justify-between mb-4">
                    <div className="flex items-center space-x-4 text-xs text-muted-foreground">
                      <div className="flex items-center space-x-1">
                        <Clock className="h-3 w-3" />
                        <span>{course.duration}</span>
                      </div>
                      <div className="flex items-center space-x-1">
                        <Users className="h-3 w-3" />
                        <span>{course.students} students</span>
                      </div>
                    </div>
                  </div>
                  
                  <Button 
                    size="sm" 
                    className="w-full"
                    variant="outline"
                  >
                    <BookOpen className="h-4 w-4 mr-2" />
                    Start Learning
                  </Button>
                </div>
              ))}
            </div>

            {board.courses.length === 0 && (
              <div className="text-center py-12 text-muted-foreground">
                <BookOpen className="h-12 w-12 mx-auto mb-4 opacity-50" />
                <h3 className="text-lg font-medium mb-2">No courses available</h3>
                <p>Courses for this board will be added soon.</p>
              </div>
            )}
          </TabsContent>
        );
      })}
    </Tabs>
  );
};

export default Boardstabs;
