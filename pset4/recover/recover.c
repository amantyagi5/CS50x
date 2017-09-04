#include <stdio.h>
#include <stdlib.h>
#include <stdint.h>

typedef uint8_t  BYTE;

int main(int argc, char* argv[])
{
    BYTE buffer[512];

    FILE* file = fopen("card.raw", "rb");
    char title[10];
    int index = -1;
    FILE* img;
    while(fread(buffer, sizeof(BYTE), 512, file) == 512)
    {
        if ((buffer[0] == 0xff && buffer[1] == 0xd8 && buffer[2] == 0xff && buffer[3] == 0xe0) || (buffer[0] == 0xff && buffer[1] == 0xd8 && buffer[2] == 0xff && buffer[3] == 0xe1))
        {
            if (index >= 0)
            {
                fclose(img);
            }
            index++;
            sprintf(title, "%03i.jpg", index);
            img = fopen(title, "a");
            fwrite(buffer, sizeof(BYTE), 512, img);
        }
        else
        {
            if (index >= 0)
            {
                fwrite(buffer, sizeof(BYTE), 512, img);
            }
        }
    }
    fclose(img);
    fclose(file);
}