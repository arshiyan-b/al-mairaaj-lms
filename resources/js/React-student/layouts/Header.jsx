import { useState } from "react";
import { Search, User, Settings, LogOut, Menu, X } from "lucide-react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuItem,
  DropdownMenuSeparator,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Avatar, AvatarFallback, AvatarImage } from "@/components/ui/avatar";
import { useIsMobile } from "@/hooks/useIsMobile";
import { Navbar } from "./Navbar";

export const Header = ({ username }) => {
  const [isSearchExpanded, setIsSearchExpanded] = useState(false);
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
  const isMobile = useIsMobile();

  const handleSearchClick = () => {
    if (isMobile && !isSearchExpanded) setIsSearchExpanded(true);
  };

  const handleSearchBlur = () => {
    if (isMobile && isSearchExpanded) setIsSearchExpanded(false);
  };

  return (
    <header className="bg-white border-b border-gray-700  top-0 z-50">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="flex items-center justify-between h-16">
          {/* Left side: Mobile menu + logo */}
          <div className="flex items-center gap-4">
            <Button
              variant="ghost"
              size="sm"
              onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
              className="md:hidden text-black hover:bg-gray-700"
              aria-label="Toggle menu"
            >
              {isMobileMenuOpen ? <X className="h-5 w-5" /> : <Menu className="h-5 w-5" />}
            </Button>

            {/* <span className="text-xl font-bold text-teal-700">AL-Mairaaj</span> */}
            <a href="/dashboard" className="hover:opacity-80 transition">
            <span className="text-xl font-bold text-teal-700">AL-Mairaaj</span>
           </a>
          </div>

          {/* Search Bar */}
          <div className="flex-1 max-w-xl mx-4">
            <div className="relative">
              <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-500" />
              <Input
                type="search"
                placeholder="Search courses, subjects, books..."
                className="pl-10 bg-gray-100 border-none rounded-full focus:ring-2 focus:ring-teal-500"
                onClick={handleSearchClick}
                onBlur={handleSearchBlur}
              />
            </div>
          </div>

          {/* Right side: Profile */}
          <div className="flex items-center gap-2">
            {/* Username text (hidden on mobile) */}
            <p className="hidden md:block">{username.name}</p>

            {/* Avatar dropdown */}
            <DropdownMenu>
              <DropdownMenuTrigger asChild>
                <Button
                  variant="ghost"
                  className="relative h-8 w-8 rounded-full hover:bg-gray-700"
                  aria-label="User profile"
                >
                  <Avatar className="h-8 w-8">
                    <AvatarImage src="" alt={username.name} />
                    <AvatarFallback className="bg-teal-700 text-white text-sm">
                      {username.name?.charAt(0).toUpperCase() || "H"}
                    </AvatarFallback>
                  </Avatar>
                </Button>
              </DropdownMenuTrigger>

              <DropdownMenuContent className="w-56" align="end">
                <DropdownMenuItem>
                  <User className="h-4 w-4 mr-2" /> My Profile
                </DropdownMenuItem>
                <DropdownMenuItem>
                  <Settings className="h-4 w-4 mr-2" /> Settings
                </DropdownMenuItem>
                <DropdownMenuSeparator />
                <DropdownMenuItem className="text-red-600">
                  <LogOut className="h-4 w-4 mr-2" /> Logout
                </DropdownMenuItem>
              </DropdownMenuContent>
            </DropdownMenu>
          </div>
        </div>

      
      </div>
      {/* Navbar receives BOTH props */}
      <Navbar
        isMobileMenuOpen={isMobileMenuOpen}
        setIsMobileMenuOpen={setIsMobileMenuOpen}
      />
    </header>
  );
};
