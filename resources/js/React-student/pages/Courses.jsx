import { BookOpen, Clock, Users } from "lucide-react";
import { Card, CardContent, CardHeader, CardTitle } from "@/components/ui/card";
import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";

const allCourses = [
  {
    id: 1,
    title: "Advanced React Development",
    instructor: "Dr. Sarah Johnson",
    progress: 75,
    duration: "12 weeks",
    students: 1200,
    status: "In Progress",
    description: "Master advanced React patterns, hooks, and performance optimization techniques.",
    image: "https://images.unsplash.com/photo-1633356122544-cd6575953051?q=80&w=2940&auto=format&fit=crop"
  },
  {
    id: 2,
    title: "JavaScript Fundamentals",
    instructor: "Prof. Michael Chen",
    progress: 100,
    duration: "8 weeks",
    students: 2500,
    status: "Completed",
    description: "Complete guide to JavaScript from basics to advanced concepts.",
    image: "https://images.unsplash.com/photo-1549692520-acc6669e2f0c?q=80&w=2711&auto=format&fit=crop"
  },
  {
    id: 3,
    title: "Python for Data Science",
    instructor: "Dr. Emily Rodriguez",
    progress: 45,
    duration: "16 weeks",
    students: 890,
    status: "In Progress",
    description: "Learn Python programming for data analysis and machine learning.",
    image: "https://images.unsplash.com/photo-1605379399843-5870eea9b7be?q=80&w=2940&auto=format&fit=crop"
  },
  {
    id: 4,
    title: "Database Design & SQL",
    instructor: "Prof. David Kumar",
    progress: 0,
    duration: "10 weeks",
    students: 675,
    status: "Not Started",
    description: "Master database design principles and advanced SQL queries.",
    image: "https://images.unsplash.com/photo-1587620962725-abab7fe55159?q=80&w=2831&auto=format&fit=crop"
  }
];

const getStatusColor = (status) => {
  switch (status) {
    case 'Completed': return 'bg-green-500 text-white dark:bg-green-600';
    case 'In Progress': return 'bg-blue-500 text-white dark:bg-blue-600';
    case 'Not Started': return 'bg-gray-500 text-white dark:bg-gray-600';
    default: return 'bg-gray-500 text-white dark:bg-gray-600';
  }
};

const Courses = () => {
  return (
    <div className="min-h-screen bg-background">
      <main className="container mx-auto px-4 py-8">
        <div className="mb-8 text-center">
          <h1 className="text-3xl font-bold tracking-tight text-foreground md:text-4xl">All Courses</h1>
          <p className="mt-2 text-muted-foreground">Explore and manage your learning journey</p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
          {allCourses.map((course) => (
            <Card key={course.id} className="bg-card/40 backdrop-blur-md border border-border/20 shadow-lg relative overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-xl hover:border-border/50">
              <div className="relative aspect-[16/9] w-full overflow-hidden">
                <img 
                  src={course.image} 
                  alt={course.title}
                  className="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                />
                
                <div className="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                
                <div className="absolute bottom-4 left-4">
                  <Badge className={getStatusColor(course.status)}>
                    {course.status}
                  </Badge>
                </div>
              </div>
              
              <CardHeader className="py-4 px-6 space-y-1">
                <CardTitle className="text-lg font-semibold leading-tight text-foreground line-clamp-1">{course.title}</CardTitle>
                <p className="text-sm text-muted-foreground line-clamp-1">{course.instructor}</p>
              </CardHeader>
              
              <CardContent className="px-6 pb-4 space-y-4 text-sm">
                <p className="text-muted-foreground line-clamp-2">
                  {course.description}
                </p>
                
                <div className="grid grid-cols-3 gap-2 text-center text-muted-foreground text-xs">
                  <div className="flex flex-col items-center">
                    <BookOpen className="h-4 w-4 text-primary" />
                    <span>{course.lessons || 10} Lessons</span>
                  </div>
                  <div className="flex flex-col items-center">
                    <Clock className="h-4 w-4 text-primary" />
                    <span>{course.duration}</span>
                  </div>
                  <div className="flex flex-col items-center">
                    <Users className="h-4 w-4 text-primary" />
                    <span>{course.students || 'N/A'} Students</span>
                  </div>
                </div>

                {course.progress > 0 && (
                  <div className="space-y-1">
                    <div className="flex justify-between text-xs">
                      <span className="text-muted-foreground">Progress</span>
                      <span className="font-medium text-foreground">{course.progress}%</span>
                    </div>
                    <div className="w-full bg-muted rounded-full h-2">
                      <div 
                        className="bg-primary h-full rounded-full transition-all duration-500"
                        style={{ width: `${course.progress}%` }}
                      />
                    </div>
                  </div>
                )}
              </CardContent>
              
              <div className="p-6 pt-0">
                <Button 
                  className="w-full rounded-md shadow-sm" 
                  variant={course.status === 'Completed' ? 'outline' : 'default'}
                >
                  {course.status === 'Completed' ? 'Review Course' : 
                   course.status === 'In Progress' ? 'Continue Learning' : 'Enroll Now'}
                </Button>
              </div>
            </Card>
          ))}
        </div>
      </main>
    </div>
  );
};

export default Courses;