#include <iostream>
#include <string> 
using namespace std;
//Structure to represent astudent 
struct Student{ 
      int rollNo;
      string name;
      float sgpa;
};
void bubbleSort(Student students[], int n) {
for (int i=0; i<n-1;i++) { 
      for(int j=0;j<n-i-1;j++){
      if(students[j].rollNo > students[j + 1].rollNo) {
            Student temp=students[j];
            students[j]=students[j + 1];
            students[j + 1] = temp;
}
// if roll numbers are the same, compare based on SGPA
else if(students[j].rollNo == students[j + 1].rollNo && students[j].sgpa>students[j + 1].sgpa) {
// Swap students
            Student temp = students[j]; students[j]=
students[j + 1];
students[j + 1] = temp;
}
}
}
}
int main() {
int n;
cout << "Enter the number of students:"; cin
>> n;
Student students[n]; 
//Input student details
for(int i = 0; i<n; i++)
{
cout << "Enter Roll No. for Student" << i+1<<":";
cin >> students[i].rollNo;
cout << "Enter Name for Student"<<i+1<<":"; cin.ignore();
// Clear the newline character from the previous input
getline(cin, students[i].name); 
cout << "Enter SGPA forStudent" <<i+1<<":";
cin >> students[i].sgpa;
}
//Perform Bubble Sort to arrange students
bubbleSort(students,n);// Display the sorted roll call list 
cout <<"Roll Call List (Sorted):" << endl; 
for(int i=0; i<n; i++) 
{
cout << "Roll No:" << students[i].rollNo <<" | Name: " << students[i].name << " | SGPA: " <<
students[i].sgpa << endl;
}
return 0;
}
