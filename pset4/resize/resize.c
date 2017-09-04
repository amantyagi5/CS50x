#include <stdio.h>
#include <stdlib.h>

#include "bmp.h"

int main(int argc, char* argv[])
{
    if (argc != 4)
    {
        printf("Usage: ./resize n infile outfile\n");
        return 1;
    }

    int n;
    if (sscanf(argv[1],"%d", &n) != 1)
    {
        printf("Usage: ./resize n infile outfile\n");
        return 1;
    }
    char* infile = argv[2];
    char* outfile = argv[3];

    FILE* inptr = fopen(infile, "r");
    if (inptr == NULL)
    {
        printf("Could not open %s.\n", infile);
        return 2;
    }

    FILE* outptr = fopen(outfile, "w");
    if (outptr == NULL)
    {
        fclose(inptr);
        fprintf(stderr, "Could not create %s.\n", outfile);
        return 3;
    }

    BITMAPFILEHEADER bf;
    fread(&bf, sizeof(BITMAPFILEHEADER), 1, inptr);

    BITMAPINFOHEADER bi;
    fread(&bi, sizeof(BITMAPINFOHEADER), 1, inptr);

    if (bf.bfType != 0x4d42 || bf.bfOffBits != 54 || bi.biSize != 40 ||
        bi.biBitCount != 24 || bi.biCompression != 0)
    {
        fclose(outptr);
        fclose(inptr);
        fprintf(stderr, "Unsupported file format.\n");
        return 4;
    }

    int paddingOri = (4 - (bi.biWidth * sizeof(RGBTRIPLE)) % 4) % 4;

    int biWidthOri = bi.biWidth;
    int biHeightOri = bi.biHeight;
    bi.biWidth *= n;
    bi.biHeight *= n;

    int padding =  (4 - (bi.biWidth * sizeof(RGBTRIPLE)) % 4) % 4;

    bf.bfSize = 14 + 40 + (bi.biWidth * sizeof(RGBTRIPLE) + padding)  * abs(bi.biHeight);
    bi.biSizeImage = (bi.biWidth * sizeof(RGBTRIPLE) + padding) * abs(bi.biHeight);

    fwrite(&bf, sizeof(BITMAPFILEHEADER), 1, outptr);

    fwrite(&bi, sizeof(BITMAPINFOHEADER), 1, outptr);

    for (int i = 0, biHeight = abs(biHeightOri); i < biHeight; i++)
    {
        for (int l = 0; l < n; l++)
        {
            for (int j = 0; j < biWidthOri; j++)
            {
                RGBTRIPLE triple;

                fread(&triple, sizeof(RGBTRIPLE), 1, inptr);

                for (int k = 0; k < n; k++)
                {
                    fwrite(&triple, sizeof(RGBTRIPLE), 1, outptr);
                }
            }
            for (int k = 0; k < padding; k++)
            {
                fputc(0x00, outptr);
            }
            fseek(inptr, -(biWidthOri * sizeof(RGBTRIPLE)), SEEK_CUR);
        }
        fseek(inptr, biWidthOri * sizeof(RGBTRIPLE), SEEK_CUR);
        fseek(inptr, paddingOri, SEEK_CUR);
    }

    fclose(inptr);

    fclose(outptr);

    return 0;
}