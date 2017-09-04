#include <stdio.h>
#include <cs50.h>

int main(void) 
{
    printf("minutes: ");
    int minutes = GetInt();
    int bottles = minutes * 12;
    printf("bottles: %i \n", bottles);
}